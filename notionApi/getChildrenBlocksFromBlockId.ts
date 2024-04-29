import 'server-only';

import { cache } from 'react';
import {
  iteratePaginatedAPI,
  isFullBlock,
  isNotionClientError,
} from '@notionhq/client';

import { notion } from './notionClient';

export type Block = Awaited<ReturnType<typeof getBlocksFromBlockId>>[number] & {
  childBlocks?: Block[];
};

export type BlockType = Block['type'];
export type BlockOfType<K = BlockType> = Extract<Block, { type: K }>;

const getBlocksFromBlockId = async (blockId: string) => {
  const blocks = [];

  try {
    // Use iteratePaginatedAPI helper function to get all blocks first-level blocks on the page
    for await (const block of iteratePaginatedAPI(notion.blocks.children.list, {
      block_id: blockId,
    })) {
      if (isFullBlock(block)) {
        blocks.push(block);
      }
    }
  } catch (error: unknown) {
    if (isNotionClientError(error)) {
      throw error;
    }
  }

  return blocks;
};

export const getChildrenBlocksFromBlockId = cache(async (blockId: string) => {
  const blocks = (await getBlocksFromBlockId(blockId)) as Block[];

  for await (const block of blocks) {
    if (block.has_children) {
      block.childBlocks = (await getBlocksFromBlockId(block.id)) as Block[];
    }
  }

  return { blocks };
});
