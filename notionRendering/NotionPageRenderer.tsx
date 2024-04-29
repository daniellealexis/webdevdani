import React from 'react';
import { Block } from '@/notionApi';
import { Heading, isHeadingBlock } from './blocks/Heading';
import { Paragraph, isParagraphBlock } from './blocks/Paragraph';
import { List, isListGroup } from './blocks/List';

import { groupRelatedBlocks, BlockOrBlockGroup } from './utils/blockGroups';
import { Callout, isCalloutBlock } from './blocks/Callout';

type NotionPageRendererProps = {
  blocks: Block[];
};

function renderBlock(block: BlockOrBlockGroup): React.ReactNode {
  if (isListGroup(block)) {
    return <List {...block} />;
  } else if (isHeadingBlock(block)) {
    return <Heading {...block} />;
  } else if (isParagraphBlock(block)) {
    return <Paragraph {...block} />;
  } else if (isCalloutBlock(block)) {
    return <Callout {...block} />;
  }

  return <p style={{ color: 'red' }}>not supported type: {block.type}</p>;
}

export const NotionPageRenderer = ({ blocks }: NotionPageRendererProps) => {
  const groupedBlocks = groupRelatedBlocks(blocks);

  return <>{groupedBlocks.map(renderBlock)}</>;
};
