import 'server-only';

import { cache } from 'react';
import { notion } from './notionClient';

const databaseId = process.env.NOTION_ROOT_DATABASE_ID;

export const getDatabaseRows = cache(async () => {
  if (!databaseId) {
    throw new Error('No environment variable found for database ID');
  }

  const response = await notion.databases.query({
    database_id: databaseId,
    sorts: [
      {
        timestamp: 'created_time',
        direction: 'ascending',
      },
    ],
  });

  return response;
});
