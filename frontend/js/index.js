const setCategories = async () => {
  const categoriesContainer = document.getElementById("categories");
  let { categories } = await get("get_categories");
  categories.forEach(({ id, title }) => {
    const category = document.createElement("div");
    category.className = "footer-link";
    const anchor = document.createElement("a");
    let query = `?id=${id}`;
    anchor.setAttribute("href", `/${query}`);
    anchor.innerHTML = title;
    category.appendChild(anchor);
    categoriesContainer.appendChild(category);
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
  } = await get(`get_posts${query}`);
  let searchParamsOlder = "";
  let searchParamsNewer = "";

  searchParamsOlder = new URLSearchParams(query);
  searchParamsNewer = new URLSearchParams(query);
  searchParamsOlder.set("page", current_page + 1);
  searchParamsNewer.set("page", current_page - 1);

  olderButton.setAttribute(
    "href",
    window.location.pathname + "?" + searchParamsOlder
  );
  newerButton.setAttribute(
    "href",
    window.location.pathname + "?" + searchParamsNewer
  );

  if (last_page > 1) {
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
  } else {
    //remove page navigation element from the DOM if there is only one page
    document.querySelector(".pagination").style.display = "none";
  }
  data.forEach(({ title, author, views, id, sample }, index) => {
    const card = cardTemplate.content.cloneNode(true);
    const anchor = card.querySelector("a");
    anchor.setAttribute("href", `./post/?post=${id}`);
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
    index < 6
      ? postsContainers[0].appendChild(card)
      : postsContainers[2].appendChild(card);
  });

  //delete elements at the bottom if there are less than 6 posts
  if (!postsContainers[2].childNodes.length) {
    postsContainers[2].style.display = "none";
  }
};

const setPopularPosts = async () => {
  const postsContainer = document.querySelectorAll(".miniBlogHolder")[1];
  const cardTemplate = document.getElementsByTagName("template")[0];
  const query = window.location.search;
  if (!cardTemplate || !postsContainer) {
    return;
  }
  let { posts } = await get(`get_populars${query}`);
  posts.forEach(({ title, author, views, id, sample }) => {
    const card = cardTemplate.content.cloneNode(true);
    const anchor = card.querySelector("a");
    anchor.setAttribute("href", `./post/?post=${id}`);
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

setCategories();
setPosts();
setPopularPosts();
