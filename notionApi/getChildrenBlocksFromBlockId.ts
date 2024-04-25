import 'server-only';

import { iteratePaginatedAPI } from '@notionhq/client';
import { cache } from 'react';

import { notion } from './notionClient';

export type BlockList = unknown[];

export const getChildrenBlocksFromBlockId = cache(
  async (blockId: string): Promise<{ blocks: BlockList }> => {
    const blocks = [];

    // Use iteratePaginatedAPI helper function to get all blocks first-level blocks on the page
    for await (const block of iteratePaginatedAPI(notion.blocks.children.list, {
      block_id: blockId,
    })) {
      blocks.push(block);
    }

    return { blocks };
  }
);
