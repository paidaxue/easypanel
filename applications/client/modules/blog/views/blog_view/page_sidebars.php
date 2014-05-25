{left_sidebar}

<div class="two-thirds column">

  <h1>Blog posts</h1>
  {POSTS}
  <div class="sixteen columns">
    <h2><a href="{BASE_URL}/blog/single/{id_post}">{title}</a></h2>
    <img src="{UP_URL}/blog/{image}" alt="image" />
    <p style="text-overflow: ellipsis;">{content}</p>
  </div>
  {/POSTS}

</div>

{right_sidebar}