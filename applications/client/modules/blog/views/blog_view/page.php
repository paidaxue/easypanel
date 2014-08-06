<!-- Left sidebar -->
<div class="one-third column">
  {left_sidebar}
</div>
<!-- End left sidebar -->

<h1>Blog posts</h1>
{POSTS}
<div class="sixteen columns">
  <h2><a href="{BASE_URL}/blog/single/{id_post}">{title}</a></h2>
  <img src="{UP_URL}/blog/{image}" alt="image" />
  <p style="text-overflow: ellipsis;">{content}</p>
</div>
{/POSTS}


<!-- Right sidebar -->
<div class="one-third column">
  {right_sidebar}
</div>
<!-- End Right sidebar -->