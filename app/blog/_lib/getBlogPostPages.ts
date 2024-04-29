import 'server-only';

import { cache } from 'react';

import { getDatabaseRows, PageObject } from '@/notionApi';
import { getPlainTextFromRichText } from '@/notionRendering/utils/getPlainTextFromRichText';

type PropertyValueType = ReturnType<typeof getPropertyValueFromPageProperties>;

type BlogPostPage = {
  pageId: string;
  title: string;
  slug: string;
  description: string;
  publishedDate: Date;
  tags: Extract<PropertyValueType, Array<{ id: string }>>;
};

function getPropertyValueFromPageProperties(
  propertyName: string,
  properties: PageObject['properties']
) {
  const propertyObject = properties[propertyName];

  if (!propertyObject) {
    throw new Error(`"${propertyName}" property not found on blog page`);
  }

  switch (propertyObject.type) {
    case 'title':
      return getPlainTextFromRichText(propertyObject.title);
      break;
    case 'rich_text':
      return getPlainTextFromRichText(propertyObject.rich_text);
    case 'date':
      return propertyObject.date?.start
        ? new Date(propertyObject.date.start)
        : new Date();
    case 'multi_select':
      return propertyObject.multi_select || [];
    default:
      return '';
  }
}

export const getBlogPostPages = cache(async (): Promise<BlogPostPage[]> => {
  const databaseRows = await getDatabaseRows();

  return databaseRows.map((row) => {
    return {
      pageId: row.id,
      title: getPropertyValueFromPageProperties('Title', row.properties),
      slug: getPropertyValueFromPageProperties('Slug', row.properties),
      description: getPropertyValueFromPageProperties(
        'Description',
        row.properties
      ),
      publishedDate: getPropertyValueFromPageProperties(
        'Published Date',
        row.properties
      ),
      tags: getPropertyValueFromPageProperties('Tags', row.properties),
    } as BlogPostPage;
  });
});
