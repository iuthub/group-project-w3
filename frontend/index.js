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
  const postsContainers = document.getElementsByClassName("miniBlogHolder");
  const cardTemplate = document.getElementsByTagName("template")[0];
  let {
    posts: { data, first_page_url, last_page_url, last_page, prev_page_url },
  } = await get("get_posts");
  console.log(data);
  data.forEach(({ title, author, body, views }, index) => {
    const card = cardTemplate.content.cloneNode(true);
    const anchor = card.querySelector("a");
    anchor.setAttribute("href", "title");
    const titleHtml = card.querySelector("h2");
    title.innerHTML = title;
    const viewsHtml = card.querySelector(".views");
    views.innerHTML = views;
    const authorHtml = card.querySelector(".author");
    author.innerHTML = author;
    console.log(card);
    postsContainers[0].appendChild(card);
  });
};

setCategories();
setPosts();
