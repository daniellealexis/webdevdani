import 'server-only';

import { cache } from 'react';
import { notion } from './notionClient';
import { isFullPage, isNotionClientError } from '@notionhq/client';

const databaseId = process.env.NOTION_ROOT_DATABASE_ID;

export type PageObject = Awaited<ReturnType<typeof getDatabaseRows>>[number];
export type PagePropertyType = PageObject['properties']['propertyName']['type'];

export const getDatabaseRows = cache(async () => {
  if (!databaseId) {
    throw new Error('No environment variable found for database ID');
  }

  try {
    const response = await notion.databases.query({
      database_id: databaseId,
      sorts: [
        {
          timestamp: 'created_time',
          direction: 'ascending',
        },
      ],
    });

    const filteredResults = response.results.filter(isFullPage);

    if (filteredResults.length) {
      return filteredResults;
    } else {
      throw new Error('No full pages returned from the database');
    }
  } catch (error: unknown) {
    if (isNotionClientError(error)) {
      throw error;
    }
  }

  return [];
});
