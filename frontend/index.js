const get = async (slug) => {
  response = await fetch(`http://blogpost.sbuy.uz/api/blog/${slug}`);
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
  });
};

const setPosts = async () => {
  const postsContainers = document.querySelectorAll(".miniBlogHolder");
  const cardTemplate = document.getElementsByTagName("template")[0];
  let {
    posts: { data, first_page_url, last_page_url, last_page, prev_page_url },
  } = await get("get_posts");
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
    anchor.setAttribute("href", `post/${id}`);
    const titleHtml = card.querySelector("h2");
    titleHtml.innerHTML = title;
    const viewsHtml = card.querySelector(".views");
    viewsHtml.innerHTML = views;
    const authorHtml = card.querySelector(".author");
    authorHtml.innerHTML = author;
    postsContainer.appendChild(card);
  });
};

const setPagination = async () => {
  const paginationBlock = document.querySelector("pagination");
  const { prev_page_url, next_page_url } = await get("get_posts");
};

setCategories();
setPosts();
setPopularPosts();
