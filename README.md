Use this very basic scafolding to start your PHP project. Point Apache at the html folder, where you can include all your regular files. You can include your views in the views folder. You can set up a heading and footing view that you can include on all your views. Pass variables in your view to modify the heading and footing of the page.

Views that start with underscore can not be referenced to direction, so any view that should only be included should start with underscore. Controllers are only called when request method post is used. If you are using get when you need a controller, you are probably doing something that should be posted, or something that would make better sense in a view.

For any libraries used there is an autoloader. This assumes the Zend Framework naming convention was used in the library. If not, you can always use the good ol' require_once.