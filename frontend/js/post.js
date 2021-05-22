const setPostData = async () => {
  const params = new URLSearchParams(window.location.search);
  const postId = params.get("post");
  const {
    post: { author, body, created_at, title },
    related,
  } = await post("get_post", { id: postId });
  const titleHtml = document.querySelector(".postTitle");
  const bodyHtml = document.querySelector("#body");
  const authorHtml = document.querySelector(".postAuthor");
  const dateHtml = document.querySelector(".postDate");
  const createdYear = created_at.slice(0, 4);
  const createdMonth = created_at.slice(5, 7);
  const createdDay = created_at.slice(8, 10);

  titleHtml.innerHTML = title;
  bodyHtml.innerHTML = body;
  authorHtml.innerHTML = author;
  console.log(created_at);
  dateHtml.innerHTML = `${createdDay}.${createdMonth}.${createdYear}`;
};

setPostData();
