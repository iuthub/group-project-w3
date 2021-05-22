let BASE_URL = "http://blogpost.sbuy.uz/api/blog/";

const olderButton = document.querySelector(".older");
const newerButton = document.querySelector(".newer");

const get = async (slug) => {
  response = await fetch(BASE_URL + slug);
  if (response.ok) {
    return response.json();
  } else
    console.log(
      new Error(
        "Something went wrong in getting a response. Please, try again!."
      )
    );
};

const setCategories = async () => {
  const categoriesContainer = document.getElementById("categories");
  let { categories } = await get("get_categories");
  console.log(categories);
  categories.forEach(({ id, title }) => {
    const category = document.createElement("div");
    category.className = "footer-link";
    const anchor = document.createElement("a");
    anchor.setAttribute("href", `/${title}`);
    anchor.innerHTML = title;
    category.appendChild(anchor);
    categoriesContainer.appendChild(category);
    category.addEventListener("click", async (event) => {
      event.preventDefault();
      response = await fetch(BASE_URL + "get_posts_by_category", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id: [id] }),
      });
      if (response.ok) {
        return response.json();
      } else
        console.log(
          new Error(
            "Something went wrong in getting a response. Please, try again!."
          )
        );
      console.log(response);
    });
  });
};

const setPosts = async (requestQuery) => {
  const postsContainers = document.querySelectorAll(".miniBlogHolder");
  postsContainers[0].innerHTML = "";
  postsContainers[2].innerHTML = "";
  const cardTemplate = document.getElementsByTagName("template")[0];
  let {
    posts: { data, current_page, next_page_url, last_page, prev_page_url },
  } = await get(`get_posts${requestQuery ? requestQuery : ""}`);

  if (current_page === 1) {
    newerButton.style.visibility = "hidden";
    olderButton.style.visibility = "visible";
    olderButton.setAttribute("href", next_page_url);
  } else if (current_page === last_page) {
    olderButton.style.visibility = "hidden";
    newerButton.style.visibility = "visible";
    newerButton.setAttribute("href", prev_page_url);
  } else {
    olderButton.style.visibility = "visible";
    newerButton.style.visibility = "visible";
    olderButton.setAttribute("href", next_page_url);
    newerButton.setAttribute("href", prev_page_url);
  }

  data.forEach(({ title, author, body, views, id }, index) => {
    const card = cardTemplate.content.cloneNode(true);
    const anchor = card.querySelector("a");
    anchor.setAttribute("href", `/post/${id}`);
    const titleHtml = card.querySelector("h2");
    titleHtml.innerHTML = title;
    const viewsHtml = card.querySelector(".views");
    viewsHtml.innerHTML = views;
    const authorHtml = card.querySelector(".author");
    authorHtml.innerHTML = author;
    index < 6
      ? postsContainers[0].appendChild(card)
      : postsContainers[2].appendChild(card);
  });
};

const setPopularPosts = async () => {
  const postsContainer = document.querySelectorAll(".miniBlogHolder")[1];
  const cardTemplate = document.getElementsByTagName("template")[0];
  let { posts } = await get("get_populars");
  posts.forEach(({ title, author, body, views, id }) => {
    const card = cardTemplate.content.cloneNode(true);
    const anchor = card.querySelector("a");
    anchor.setAttribute("href", `../post`);
    const titleHtml = card.querySelector("h2");
    titleHtml.innerHTML = title;
    const viewsHtml = card.querySelector(".views");
    viewsHtml.innerHTML = views;
    const authorHtml = card.querySelector(".author");
    authorHtml.innerHTML = author;
    postsContainer.appendChild(card);
  });
};

setCategories();
setPosts();
setPopularPosts();

olderButton.addEventListener("click", (event) => {
  event.preventDefault();
  setPosts(olderButton.search);
});

newerButton.addEventListener("click", (event) => {
  event.preventDefault();
  setPosts(newerButton.search);
});
