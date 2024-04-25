import Link from 'next/link';
import { getBlogPostPages } from '../_lib/getBlogPostPages';

export default async function BlogPostList() {
  const blogPosts = await getBlogPostPages();

  return (
    <ol>
      {blogPosts.map((post) => (
        <li key={post.pageId}>
          <Link href={`/blog/${post.slug}`}>{post.title}</Link>
        </li>
      ))}
    </ol>
  );
}
