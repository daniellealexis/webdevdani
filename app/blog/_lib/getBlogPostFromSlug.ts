import 'server-only';

import { cache } from 'react';
import { getBlogPostPages } from './getBlogPostPages';

export const getBlogPostFromSlug = cache(async (slug: string) => {
  const blogPosts = await getBlogPostPages();
  const postBySlug = blogPosts.find((post) => post.slug === slug);

  if (!postBySlug) throw new Error(`Cannot find post for the slug: "${slug}"`);

  return postBySlug;
});
