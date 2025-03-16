document.addEventListener("DOMContentLoaded", async function () {
    const postsContainer = document.getElementById("posts-container");

    try {
        const response = await fetch("https://jsonplaceholder.typicode.com/posts");
        if (!response.ok) {
            throw new Error("Ошибка загрузки постов");
        }

        const posts = await response.json();
        postsContainer.innerHTML = "";

        posts.forEach(post => {
            const postElement = document.createElement("div");
            postElement.classList.add("post");
            postElement.innerHTML = `
                <h2><a href="post.html?id=${post.id}">${post.title}</a></h2>
                <p>${post.body.substring(0, 100)}...</p>
            `;
            postsContainer.appendChild(postElement);
        });

    } catch (error) {
        postsContainer.innerHTML = `<p style="color: red;">Ошибка: ${error.message}</p>`;
    }
});
