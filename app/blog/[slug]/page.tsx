import { Metadata, ResolvingMetadata } from 'next';

import { getChildrenBlocksFromBlockId } from '@/notionApi';
import { getBlogPostPages } from '../_lib/getBlogPostPages';
import { getBlogPostFromSlug } from '../_lib/getBlogPostFromSlug';
import { NotionPageRenderer } from '@/notionRendering';

type BlogPageProps = {
  params: { slug: string };
};

export const revalidate = 3600;

async function getData(slug: string) {
  const blogPostPage = await getBlogPostFromSlug(slug);
  const data = await getChildrenBlocksFromBlockId(blogPostPage.pageId);
  return { ...blogPostPage, ...data };
}

export const dynamicParams = false;

export async function generateStaticParams(): Promise<
  Array<BlogPageProps['params']>
> {
  const blogPosts = await getBlogPostPages();
  return blogPosts.map((post) => ({ slug: post.slug }));
}

// The redirect() and notFound() Next.js methods can also be used inside generateMetadata.
export async function generateMetadata(
  { params }: BlogPageProps,
  parent: ResolvingMetadata
): Promise<Metadata> {
  // read route params
  const { slug } = params;
  const page = await getBlogPostFromSlug(slug);

  // optionally access and extend (rather than replace) parent metadata
  const previousImages = (await parent).openGraph?.images || [];

  return {
    title: page.title,
    description: page.description,
    openGraph: {
      images: [...previousImages],
    },
  };
}

export default async function BlogPage({ params }: BlogPageProps) {
  const data = await getData(params.slug);

  return (
    <div>
      <h1>{data.title}</h1>
      {/* <pre>{JSON.stringify(data, null, 2)}</pre> */}
      <NotionPageRenderer blocks={data.blocks} />
    </div>
  );
}
