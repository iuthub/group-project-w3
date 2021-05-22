let BASE_URL = "http://ipblog.sbuy.uz/api/blog/";

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
