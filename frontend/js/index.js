let BASE_URL = "http://blogpost.sbuy.uz/api/blog/";
// let BASE_URL = "http://ipblog.sbuy.uz/api/blog/";

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

const post = async (slug, body, options = {}) => {
  response = await fetch(BASE_URL + slug, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(body),
    ...options,
  });
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

      const response = await post("get_posts_by_category", { id: [id] });

      console.log(response);
    });
  });
};

const setPosts = async () => {
  const postsContainers = document.querySelectorAll(".miniBlogHolder");
  if (!postsContainers.length || !postsContainers[2]) {
    return;
  }
  postsContainers[0].innerHTML = "";
  postsContainers[2].innerHTML = "";
  const cardTemplate = document.getElementsByTagName("template")[0];
  if (!cardTemplate) {
    return;
  }
  const query = window.location.search;
  let {
    posts: { data, current_page, last_page },
  } = await get(`get_posts${query ? query : ""}`);

  const searchParams = window.location.search;
  let searchParamsOlder = "";
  let searchParamsNewer = "";
  if (searchParams) {
    searchParamsOlder = new URLSearchParams(searchParams);
    searchParamsNewer = new URLSearchParams(searchParams);
    searchParamsOlder.set("page", current_page + 1);
    searchParamsNewer.set("page", current_page - 1);
  } else {
    searchParamsOlder = `page=${current_page + 1}`;
    searchParamsNewer = `page=${current_page - 1}`;
  }

  olderButton.setAttribute(
    "href",
    window.location.pathname + "?" + searchParamsOlder
  );
  newerButton.setAttribute(
    "href",
    window.location.pathname + "?" + searchParamsNewer
  );

  if (current_page === 1) {
    newerButton.style.visibility = "hidden";
    olderButton.style.visibility = "visible";
  } else if (current_page === last_page) {
    olderButton.style.visibility = "hidden";
    newerButton.style.visibility = "visible";
  } else {
    olderButton.style.visibility = "visible";
    newerButton.style.visibility = "visible";
  }

  data.forEach(({ title, author, body, views, id }, index) => {
    const card = cardTemplate.content.cloneNode(true);
    const anchor = card.querySelector("a");
    anchor.setAttribute("href", `./post/?post=${id}`);
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
  if (!cardTemplate || !postsContainer) {
    return;
  }
  let { posts } = await get("get_populars");
  posts.forEach(({ title, author, body, views, id }) => {
    const card = cardTemplate.content.cloneNode(true);
    const anchor = card.querySelector("a");
    anchor.setAttribute("href", `./post/?post=${id}`);
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
