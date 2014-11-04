Extension provides a convenient interface for moving items between containers.<br/>
After submit form with YiiMultiBox you can get state of changed list.<br/>

Creates a drag&drop multiboxes based on http://blog.tool-man.org/2005/04/15/drag-between-lists/12/<br/>
Example with 2 lists - http://neb.net/playground/dragdrop/<br/>
Description (Rus) - http://tyvik.blogspot.ru/2013/05/yii-yiimultibox.html

Requirements:
 - Yii 1.1 or more (Tested on 1.13)

Usage:<br/>
Place yiimultibox folder in /protected/widget/. Add to form views as needed:

```php
$form->widget('application.widget.yiimultibox.YiiMultiBox', array(
    'form' => 'some-form',
    'boxes' => $someLists)
);
```

where
 - form - some form for submit data (changed lists) to server;
 - boxes - array of list, eg:

```php
array(
    idContainers => array(
        // optional, visible header for list
        'header' => 'header of list 1',
        'data' => array( 
            // elements
            idElements => array(
                'name' => 'visible name',
                'htmlOptions' => array( as Yii htmlOptions), // optional
            ),
        ),
        'htmlOptions' => array( as Yii htmlOptions), // optional
    )
)
```

After submit form with YiiMultiBox you can get changed lists from $_POST['YiiMultiBox'], eg:<br/>
```php
if (isset($_POST['YiiMultiBox'])) {
    $lists = json_decode($_POST['YiiMultiBox']);
    foreach ($lists as $idContainers => $values) {
        foreach ($values as $idElements) {
        // some process
        }
    }
}
```
