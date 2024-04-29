import React from 'react';

import { Block } from '@/notionApi';
import { InnerText } from '../InnerText';
import { BlockOrBlockGroup } from '../utils/blockGroups';

type HeadingBlock = Extract<
  Block,
  { type: 'heading_1' } | { type: 'heading_2' } | { type: 'heading_3' }
>;

export function isHeadingBlock(
  block: BlockOrBlockGroup
): block is HeadingBlock {
  const { type } = block;
  return type === 'heading_1' || type === 'heading_2' || type === 'heading_3';
}

// Should headings actually be h2 - h4? So page title can be h1
export const Heading = (props: HeadingBlock) => {
  switch (props.type) {
    case 'heading_1':
      return (
        <h2>
          <InnerText {...props.heading_1} blockId={props.id} />
        </h2>
      );
    case 'heading_2':
      return (
        <h3>
          <InnerText {...props.heading_2} blockId={props.id} />
        </h3>
      );
    case 'heading_3':
      return (
        <h4>
          <InnerText {...props.heading_3} blockId={props.id} />
        </h4>
      );
    default:
      return null;
  }
};
