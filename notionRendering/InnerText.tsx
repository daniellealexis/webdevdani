import React from 'react';

import { Block } from '@/notionApi';

type InnerTextProperties = Extract<Block, { type: 'paragraph' }>['paragraph'];

type Annotations = InnerTextProperties['rich_text'][number]['annotations'];

// TODO: Style classes for rich_text.annotation
function getAnnotationClasses(annotations: Annotations) {
  const classNames: string[] = [];

  if (annotations.bold) classNames.push('font-bold');
  if (annotations.italic) classNames.push('italic');
  if (annotations.underline) classNames.push('underline');
  if (annotations.strikethrough) classNames.push('line-through');
  if (annotations.code) classNames.push('--inline-code');
  if (annotations.color && annotations.color !== 'default')
    classNames.push(`--color-${annotations.color}`); // TODO: color support

  return classNames;
}

export const InnerText = ({
  rich_text,
  blockId,
}: InnerTextProperties & { blockId: string }) => {
  return (
    <>
      {rich_text.map((richTextItem, idx) => {
        const annotationClasses = getAnnotationClasses(
          richTextItem.annotations
        ).join(' ');

        return richTextItem.href ? (
          <a
            key={`${blockId}_${idx}`}
            href={richTextItem.href}
            className={annotationClasses}
          >
            {richTextItem.plain_text}
          </a>
        ) : (
          <span key={`${blockId}_${idx}`} className={annotationClasses}>
            {richTextItem.plain_text}
          </span>
        );
      })}
    </>
  );
};
