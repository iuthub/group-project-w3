//Function used to get an IP of user to count the number of views. Source :
// https://www.codegrepper.com/code-examples/javascript/get+ip+only+vanilla+javascript
const getIP = async (json) => {
  if (!window.localStorage.getItem("ip")) {
    window.localStorage.setItem("ip", json.ip);
  }
};

const setPostData = async () => {
  const params = new URLSearchParams(window.location.search);
  const postId = params.get("post");
  const {
    post: { author, body, created_at, title, id },
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
  setRecommendedPosts(related);

  //send data when a post is visited from an IP
  post("check_ip", {
    post_id: id,
    ip: window.localStorage.getItem("ip"),
  });
};

const setRecommendedPosts = (related) => {
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
