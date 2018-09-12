function control_de_menu(menu){
	menu.parents('li.treeview').addClass('menu-open');
	menu.parents('ul.treeview-menu').css('display','block');
	menu.parent().addClass('active');
}