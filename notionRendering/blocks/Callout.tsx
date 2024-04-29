import React from 'react';

import { Block } from '@/notionApi';
import { InnerText } from '../InnerText';
import { BlockOrBlockGroup } from '../utils/blockGroups';
import { NotionPageRenderer } from '../NotionPageRenderer';

type CalloutBlock = Extract<Block, { type: 'callout' }>;

export function isCalloutBlock(
  block: BlockOrBlockGroup
): block is CalloutBlock {
  return block.type === 'callout';
}

export const Callout = (props: CalloutBlock) => {
  // TODO: External & file support for icon?
  // TODO: Hide emoji from screenreaders

  return (
    <div className={`callout --${props.callout.color}`}>
      {props.callout.icon?.type === 'emoji' ? (
        <p>
          <span>{props.callout.icon.emoji}</span>
        </p>
      ) : null}
      <p>
        <InnerText {...props.callout} blockId={props.id} />
      </p>
      {props.childBlocks?.length ? (
        <div>
          <NotionPageRenderer blocks={props.childBlocks} />
        </div>
      ) : null}
    </div>
  );
};
