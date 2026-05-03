<?php
echo "<h1>Лабораторная работа 14</h1>";

class Page
{
    private string $name;
    private string $template;

    public function __construct()
    {
        $this->name = "page";
        $this->template = "<div><p>It is a default page</p></div>";
    }

    public function render(): void
    {
        echo $this->template;
    }
}

class BlogPage extends Page
{
    public function __construct()
    {
        $this->name = "blog";
        $this->template = '
            <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                <div style="border: 1px solid #ccc; padding: 15px; width: 200px;">
                    <h3>Заголовок 1</h3>
                    <p>Текст карточки 1</p>
                </div>
                <div style="border: 1px solid #ccc; padding: 15px; width: 200px;">
                    <h3>Заголовок 2</h3>
                    <p>Текст карточки 2</p>
                </div>
                <div style="border: 1px solid #ccc; padding: 15px; width: 200px;">
                    <h3>Заголовок 3</h3>
                    <p>Текст карточки 3</p>
                </div>
            </div>
        ';
    }
}

$page = new Page();
$blogPage = new BlogPage();

echo '<div style="margin: 20px 0;">
    <a href="?page=page">Страница 1 (Page)</a> | 
    <a href="?page=blog">Страница 2 (Blog)</a>
</div>';

if (isset($_GET['page'])) {
    $pageParam = $_GET['page'];
    
    if ($pageParam === 'page') {
        echo "<h2>Страница Page</h2>";
        $page->render();
    } elseif ($pageParam === 'blog') {
        echo "<h2>Страница Blog</h2>";
        $blogPage->render();
    } else {
        $page->render();
    }
} else {
    $page->render();
}
?>
