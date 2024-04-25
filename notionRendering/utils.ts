// import * as NotionStuff from '@notionhq/client';

export const getPlainTextFromRichText = (
  richText: Array<{ plain_text: string }>
) => {
  return richText.map((t) => t.plain_text).join('');
};
