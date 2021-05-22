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
  dateHtml.innerHTML = `${createdDay}.${createdMonth}.${createdYear}`;

  //Set recommended posts
  const postsContainer = document.querySelector(".miniBlogHolder");
  const cardTemplate = document.getElementsByTagName("template")[0];

  related.forEach(({ title, author, sample, views, id }) => {
    const card = cardTemplate.content.cloneNode(true);
    const anchor = card.querySelector("a");
    anchor.setAttribute("href", `../post/?post=${id}`);
    const titleHtml = card.querySelector("h2");
    titleHtml.innerHTML = title;
    const viewsHtml = card.querySelector(".views");
    viewsHtml.innerHTML = views;
    const authorHtml = card.querySelector(".author");
    authorHtml.innerHTML = author;
    if (sample) {
      const imageHtml = card.querySelector(".preview");
      imageHtml.setAttribute("src", "http://ipblog.sbuy.uz/storage/" + sample);
    }
    postsContainer.appendChild(card);
  });
};

setPostData();
