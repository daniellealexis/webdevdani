import React from 'react';

import { InnerText } from '../InnerText';
import { BlockGroup, BlockOrBlockGroup } from '../utils/blockGroups';
import { NotionPageRenderer } from '../NotionPageRenderer';

export type ListGroup =
  | BlockGroup<'bulleted_list_item'>
  | BlockGroup<'numbered_list_item'>;

export function isListGroup(block: BlockOrBlockGroup): block is ListGroup {
  return (
    block.type === 'group' &&
    (block.itemType === 'bulleted_list_item' ||
      block.itemType === 'numbered_list_item')
  );
}

export const List = (props: ListGroup) => {
  if (props.itemType === 'bulleted_list_item') {
    return (
      <ul className="list-disc list-inside ms-4">
        {props.items.map((listItem) => (
          <li key={listItem.id}>
            <InnerText blockId={listItem.id} {...listItem.bulleted_list_item} />
            {listItem.childBlocks?.length ? (
              <NotionPageRenderer blocks={listItem.childBlocks} />
            ) : null}
          </li>
        ))}
      </ul>
    );
  } else if (props.itemType === 'numbered_list_item') {
    return (
      <ol className="list-decimal list-inside">
        {props.items.map((listItem) => (
          <li key={listItem.id}>
            <InnerText blockId={listItem.id} {...listItem.numbered_list_item} />
            {listItem.childBlocks?.length ? (
              <NotionPageRenderer blocks={listItem.childBlocks} />
            ) : null}
          </li>
        ))}
      </ol>
    );
  }

  return null;
};
