import 'server-only';

import { Client } from '@notionhq/client';

const apiKey = process.env.NOTION_KEY;

export const notion = new Client({ auth: apiKey });
