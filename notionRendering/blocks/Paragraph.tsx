import React from 'react';

import { Block } from '@/notionApi';
import { InnerText } from '../InnerText';
import { BlockOrBlockGroup } from '../utils/blockGroups';
import { NotionPageRenderer } from '../NotionPageRenderer';

type ParagraphBlock = Extract<Block, { type: 'paragraph' }>;

export function isParagraphBlock(
  block: BlockOrBlockGroup
): block is ParagraphBlock {
  return block.type === 'paragraph';
}

export const Paragraph = (props: ParagraphBlock) => {
  return (
    <>
      <p className="text-base">
        <InnerText {...props.paragraph} blockId={props.id} />
      </p>
      {props.childBlocks?.length ? (
        <div>
          <NotionPageRenderer blocks={props.childBlocks} />
        </div>
      ) : null}
    </>
  );
};
