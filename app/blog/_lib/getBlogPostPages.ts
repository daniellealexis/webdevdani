import 'server-only';

import { cache } from 'react';
import { isFullPage } from '@notionhq/client';

import { getDatabaseRows } from '@/notionApi';
import { getPlainTextFromRichText } from '@/notionRendering/utils';

type BlogPostPage = {
  pageId: string;
  title: string;
  slug: string;
  description: string;
  publishedDate: Date | null;
  tags?: Array<unknown>;
};

export const getBlogPostPages = cache(async (): Promise<BlogPostPage[]> => {
  const databaseRows = await getDatabaseRows();

  // TODO: Make extract helper for getting these values

  return databaseRows.results.filter(isFullPage).map((row) => {
    return {
      pageId: row.id,
      title:
        row.properties.Title.type === 'title'
          ? getPlainTextFromRichText(row.properties.Title.title)
          : '',
      slug:
        row.properties.Slug.type === 'rich_text'
          ? getPlainTextFromRichText(row.properties.Slug.rich_text)
          : '',
      description:
        row.properties.Description.type === 'rich_text'
          ? getPlainTextFromRichText(row.properties.Description.rich_text)
          : '',
      publishedDate:
        row.properties['Published Date'].type === 'date' &&
        row.properties['Published Date'].date?.start
          ? new Date(row.properties['Published Date'].date?.start)
          : new Date(),
      tags:
        row.properties.Tags.type === 'multi_select'
          ? row.properties.Tags.multi_select
          : [],
    };
  });
});
