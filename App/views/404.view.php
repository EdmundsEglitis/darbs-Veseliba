<?php require "../App/views/components/head.php" ?>

<div class="missing-box">
    <div class="PageNotFound-Container">
        <h1 class="center PageNotFound"">Oops! Page Not Found</h1>
        <p class="description" style="color:white;">It seems like the page you're looking for has taken a vacation. Perhaps it’ll return soon, but in the meantime, you can head back to the homepage!</p>
        <form action="/" method="post">
            <button class="fourOfour-button" type="submit">Home</button>
        </form>
    </div>
</div>

<?php require "../App/views/components/footer.php" ?>

<style>
  html, body {
    height: auto;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch; /* smooth scroll on iOS */
}

  body {
    background-color: #212121;
    background: linear-gradient(90deg, #212121, #424242);
    background-size: 300% 200%;
    animation: backgroundMove 10s ease infinite;
    margin: 0;
    font-family: Arial, sans-serif;
  }

  @keyframes backgroundMove {
    0% { background-position: 0% 0%; }
    50% { background-position: 100% 100%; }
    100% { background-position: 0% 0%; }
  }
  
  .missing-box {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    font-family: Arial, sans-serif;
  }
  
  .PageNotFound-Container {
    text-align: center;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  .PageNotFound {
    font-size: 3rem;
    margin-bottom: 20px;
    color: #dc3545;
  }
  
  .fourOfour-button {
    width: 120px;
    background-color: #007bff;
    color: #ffffff;
    border: none;
    border-radius: 5px;
    padding: 10px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .fourOfour-button:hover {
    background-color: #0056b3;
  }
  
  .center {
    text-align: center;
  }
  
  .description {
    margin-bottom: 20px;
    font-size: 1.2rem;
  }
</style>