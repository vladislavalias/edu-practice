<?php require_once 'logVerification.php' ?>

<!DOCTIPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <?php
    require_once 'function.php';
    $id = filter_input(INPUT_GET, 'id');
    $where = sprintf('id="%d"', $id);
    $books = mysqlSelect('books', '*', $where);
    mysqlConnect();
    foreach ($books as $book)
    {
      $name   = $book['name'];
      $author = $book['author'];
      $text   = $book['text'];
    }
    ?>
      <form action="redact.php?id=<?php echo $id ?>" method="post">
        <table>
            <tr>
                <td>Название книги:</td>
                <td><input type="text" name="name" value="<?php echo getFromPost('name') ? getFromPost('name') : $name ?>"></td>
            </tr>
            <tr>
                <td>Автор:</td>
                <td><input type="text" name="author" value="<?php echo getFromPost('author') ? getFromPost('author') : $author ?>"></td>
            </tr>
            <tr>
                <td>Содержание:</td>
                <td>
                    <textarea class="text" name="text"><?php echo getFromPost('text') ? getFromPost('text') : $text ?></textarea>                
                </td>
            </tr>
        </table>
        <input type="submit" value="Редактировать">
    </form>
      <a href="index.php">Перейти к списку книг</a>
  </body>
</html>

<?php
//че? че то ты мою идею извратил малеха
//знаешь? я не расслышал хм ладно
require_once 'saveForm.php';
//безусловное обновление? без проверки отправки формы?))))))) сразу при открытии страницы?))))))
//ипануться
//атата
//ну не совсем, ты должен проверить отправлена ли форма и тогда только ее обрабатывать
//а сейчас у тебя обработка идет при открытии страницы, причем сразу жже так как данные не отправлены
//то обновляет на пустоты вот и все
//а что бы обработку делать то есть два пути
//первйы делать тут ифом типо если в посте есть данные но не такие как ты написал а скажем что бы они
//были в посте массивом как это сделать? легко надо неймы выдавать как для массива с именем фомы наппример
//и тут в этом же файле проверяешь есть ли в после едит_форм если есть хоть что то значит форма отправлена
//
//но есть второй путь намного лучше и проще так сказать почему? щас поймешь
//делаешь второй фалик на который ссылаешь экш и там форму обрабаываешь естественно тоже с проверкой
//но так как оно будет у тебя вынесено отдельно то тут не будет лишнего нагромождения логики
//
//т.е. смотри если первый путь то вначале файла этого ты ставишь иф если форма отправлена то обновляем, но при этом
//же надо проверить форму т.е. лишние строки - показ формы и логика обновления вместе, не будет очень красиво так
//как тут у тебя еще и верстка
//
//а если отдельный файлик то там будет только обработка формы и ничего больше без хтмл что явно будет симпатичнее и в нем
//будет легче потом разобраться
//ну и придумать например в форме типо экшн который будет указывать редактировать или создавать
//и опять же в отдельном файле ты сможешь развести эту логику
//
//а если по первому пути то в каждом файле тебе надо будет ее фигачить отдельно со всеми валидациями что не очень гуд и все такое)
//$query = sprintf('UPDATE books SET name="%s", author="%s", text="%s" WHERE id="%d"', filter_input(INPUT_POST, 'name'), filter_input(INPUT_POST, 'author'), filter_input(INPUT_POST, 'text'), $id);
//$q = mysql_query($query);