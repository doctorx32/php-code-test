# Funeral Zone PHP Code Test 

You need to refactor this class, it is a simple class that makes a call to a http API to retrieve a list of books and return them. Think about extensibility - how could you easily add other book seller APIs in the the future, handle different API formats, different query types (by publisher, by year published etc - things like that). 

Refactor this to what you consider to be production ready code.

## Usage 
0. run `composer install`
0. run `public/index.php` file.

## Notes
First of all I added namespaces with Composer.

Component `symfony/routing` added to provide handling other query types - you can easily add new route, 
pass new parameters and replace in GetBookList class. Also added Dependency Injection component for
common development way. Next I would add DotEnv implementation, because its modern and extensible way 
to store project secrets, especially at the deployment, but for this stage of project it is not necessary.

Class `OutputStrategy` implements Programming pattern Strategy for convenient output approaches resolving.