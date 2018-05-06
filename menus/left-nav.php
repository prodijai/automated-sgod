
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
          <ul class="nav nav-pills flex-column">
            <?php createSidebarMenu("Data Input Management","data-input","disabled"); ?>
            <?php createSidebarMenu("List Forms","list-forms",$_GET['p']); ?>
            <?php listAvailableForms($_GET['f']); ?>
          </ul>

          <ul class="nav nav-pills flex-column">
            <?php createSidebarMenu("Data Output Management","data-output","disabled"); ?>
            <?php createSidebarMenu("View Reports","list-reports",$_GET['p']); ?>
            <?php createSidebarMenu("Header & Footers","list-template",$_GET['p']); ?>

          </ul>

          <ul class="nav nav-pills flex-column">
            <?php createSidebarMenu("Entities","entities","disabled"); ?>
            <?php createSidebarMenu("List Entities","list-entities",$_GET['p']); ?>
            <?php listEntities($_GET['e']); ?>
          </ul>

          <ul class="nav nav-pills flex-column">
            <?php createSidebarMenu("Management & Administration","management","disabled"); ?>
            <?php createSidebarMenu("New Form","new-form",$_GET['p']); ?>
            <?php //createSidebarMenu("New Field","add-fields",$_GET['p']); ?>
            <?php createSidebarMenu("New Entity","new-entity",$_GET['p']); ?>
            <?php createSidebarMenu("New School","new-school",$_GET['p']); ?>
            <?php createSidebarMenu("List Fields","list-fields",$_GET['p']); ?>
            <?php createSidebarMenu("List Schools","list-schools",$_GET['p']); ?>
          </ul>
        </nav>