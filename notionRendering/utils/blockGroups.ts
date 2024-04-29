import { Block, BlockType, BlockOfType } from '@/notionApi';

type GroupableBlockType = Extract<
  BlockType,
  'bulleted_list_item' | 'numbered_list_item'
>;

export type BlockOrBlockGroup = ReturnType<typeof groupRelatedBlocks>[number];

export type GroupableBlock =
  | BlockOfType<'bulleted_list_item'>
  | BlockOfType<'numbered_list_item'>;

function isGroupableBlock(block: Block): block is GroupableBlock {
  return (
    block.type === 'bulleted_list_item' || block.type === 'numbered_list_item'
  );
}

export type BlockGroup<BlockTypeKey = GroupableBlockType> = {
  type: 'group';
  itemType: BlockTypeKey;
  items: Extract<Block, { type: BlockTypeKey }>[];
};

export function createBlockGroup<T = GroupableBlockType>({
  itemType,
  items,
}: {
  itemType: T;
  items: Extract<Block, { type: T }>[];
}) {
  return {
    type: 'group' as const,
    itemType,
    items,
  };
}

export function groupRelatedBlocks(blocks: Block[]) {
  const groupedBlocks = [];
  let group: BlockGroup | null = null;

  for (let i = 0; i < blocks.length; i++) {
    const block = blocks[i];

    // If the block isn't in the group we're building, add it to the block list
    // and reset the stack state
    if (group && group.items.length && group.itemType !== block.type) {
      groupedBlocks.push(group);
      group = null;
    }

    if (group && group.type && block.type === group.itemType) {
      // If current group.type and blockType are the same, add to stack
      group.items.push(block);
    } else if (isGroupableBlock(block)) {
      // if groupable type, start new stack
      group = createBlockGroup({ itemType: block.type, items: [block] });
    } else {
      // else push block to the list as is
      groupedBlocks.push(block);
    }
  }

  if (group) {
    groupedBlocks.push(group);
  }

  return groupedBlocks;
}
