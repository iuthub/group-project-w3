const get = async (slug) => {
  response = await fetch(`http://blogpost.sbuy.uz/api/blog/${slug}`);
  if (response.ok) {
    console.log(response);
  } else
    console.log(
      new Error(
        "Something went wrong in getting a response! Please, reload the page."
      )
    );

  return response.json();
};

const setCategories = async () => {
  const categoriesContainer = document.getElementById("categories");
  let { categories } = await get("get_categories");
  console.log(categories);
  const newList = categories.forEach(({ id, title }) => {
    const category = document.createElement("div");
    category.className = "footer-link";
    const anchor = document.createElement("a");
    anchor.setAttribute("href", `/${title}`);
    anchor.innerHTML = title;
    category.appendChild(anchor);
    categoriesContainer.appendChild(category);
    console.log(category);
  });
  console.dir(newList);
};

setCategories();
