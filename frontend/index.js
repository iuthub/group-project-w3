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
