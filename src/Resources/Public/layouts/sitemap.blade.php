{!! '<' . '?' . 'xml version="1.0" encoding="UTF-8"' . '?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
	<url>
      <loc>{!!route('trangchu')!!}</loc>
      <lastmod>{!!date('Y-m-d')!!}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
   </url>
   <url>
      <loc>{!!route('gioithieu')!!}</loc>
      <lastmod>{!!date('Y-m-d')!!}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
   </url>
   <url>
      <loc>{!!route('phanmem')!!}</loc>
      <lastmod>{!!date('Y-m-d')!!}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
   </url>
   <url>
      <loc>{!!route('dichvu')!!}</loc>
      <lastmod>{!!date('Y-m-d')!!}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
   </url>
   <url>
      <loc>{!!route('tintuc')!!}</loc>
      <lastmod>{!!date('Y-m-d')!!}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
   </url>
   <url>
      <loc>{!!route('sukienkm')!!}</loc>
      <lastmod>{!!date('Y-m-d')!!}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
   </url>
   <url>
      <loc>{!!route('staticpage', ['lien-he'])!!}</loc>
      <lastmod>{!!date('Y-m-d')!!}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
   </url>
   @foreach($list as $item)
   <url>
      <loc>{!!route($item->url, [$item->re_name])!!}</loc>
      <lastmod>{!!date('Y-m-d')!!}</lastmod>
      <changefreq>daily</changefreq>
      <priority>0.8</priority>
   </url>
   @endforeach
</urlset>	