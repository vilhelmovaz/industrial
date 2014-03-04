<?php

include_once 'header.php';

navigate();

$control->initialize();
$view->initialize();
?>
    <!DOCTYPE html>
    <head>
   <meta charset='UTF-8' />
   <script type="text/javascript" src="./tinymce/tinymce.min.js"></script>
   <script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        schema: "html5",
        skin: "tundora",
        add_unload_trigger: false,
        relative_urls: "false",
        style_formats: [
            {title: 'Headers', items: [
                {title: 'h3', block: 'h3'},
                {title: 'h4', block: 'h4'},
                {title: 'h5', block: 'h5'},
                {title: 'h6', block: 'h6'}
            ]},

            {title: 'Blocks', items: [
                {title: 'p', block: 'p'},
                {title: 'div', block: 'div'},
                {title: 'pre', block: 'pre'}
            ]},

            {title: 'Containers', items: [
                {title: 'section', block: 'section', wrapper: true, merge_siblings: false},
                {title: 'article', block: 'article', wrapper: true, merge_siblings: false},
                {title: 'blockquote', block: 'blockquote', wrapper: true},
                {title: 'hgroup', block: 'hgroup', wrapper: true},
                {title: 'aside', block: 'aside', wrapper: true},
                {title: 'figure', block: 'figure', wrapper: true}
            ]}
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
        plugins: [
            "advlist autolink link image lists charmap preview hr pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
            "save table contextmenu directionality emoticons template paste textcolor jbimages"
        ],
        templates: [
            {title: 'Article', description: 'Article with header h3', url: './tinymce/templates/test.html'}
        ]
    });
    </script>
   <link rel='stylesheet' type='text/css' href='css/style.css' title='default' />

   </head>
    <title>
<?php

$view->printTitle();
echo("</title><header>");
include_once 'menu.php';
echo("</header><body><h1>");
$view->printPageHeader();
echo("</h1><section><div id='content'>");
//echo "get: ";
//var_dump($_GET);
//echo "</br>post: ";
//var_dump($_POST);

$view->printBody();
echo("</div></section><footer>");
$view->printFooter();
echo("</footer><br class='clear' /></body></html>");



/*

$test = new UserIcon(1, addslashes(file_get_contents("BronzeChestplate.png")));

UserIconDAO::reset($test);
*/
//var_dump($test);

/*
header("Content-type: image/png");
$result = $test->getImage();
echo "$result";
*/