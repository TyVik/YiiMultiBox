Extension provides a convenient interface for moving items between containers.
After submit form with YiiMultiBox you can get state of changed list.

Creates a drag&drop multiboxes based on http://blog.tool-man.org/2005/04/15/drag-between-lists/12/
Example with 2 lists - http://neb.net/playground/dragdrop/

Requirements

Yii 1.1 or more (Tested on 1.13)

Usage

Place yiimultibox folder in /protected/widget/. Add to form views as needed:

$form->widget('application.widget.yiimultibox.YiiMultiBox', array(
    'form' => 'some-form',
    'boxes' => $someLists)
);
where
 - form - some form for submit data (changed lists) to server;
 - boxes - array of list, eg:
    array(
        idList1 => array(
            'header' => 'header of list 1' (optional, visible header for list),
            'data' => array( (elements)
                idElement1 => array(
                    'name' => 'visible name',
                    'htmlOptions' => array( as Yii htmlOptions),
                ),
            ),
        )
    )

After submit form with YiiMultiBox you can get changed lists from $_POST['YiiMultiBox'], eg:
    if (isset($_POST['YiiMultiBox'])) {
        $lists = json_decode($_POST['YiiMultiBox']);
        foreach ($lists as $idList => $values) {
            foreach ($values as $elementOfList) {
            // some process
            }
        }
    }
