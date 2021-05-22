const setPostData = async () => {
  const params = new URLSearchParams(window.location.search);
  const postId = params.get("post");
  const {
    post: { author, body, created_at, title },
    related,
  } = await post("get_post", { id: postId });
  console.log(response);
};

setPostData();
