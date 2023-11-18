# Roox Pseudomodule
# Rukovoditel Plug In 

A regular Rukovoditel module consists of two important parts: actions and views.

This plugin can mimic both. You just have to create PHP script to act, either as an action or a view.

# How to install
The installation is pretty straightforward.
1. Copy all files into a your own plugin folder, e.g. 'roox'
2. Open your server setting (_server.php_) in Rukovoditel's config folder and add the plugin's name.
   For example:
   ```
   //list of available plugins separated by comma

   define('AVAILABLE_PLUGINS','ext,roox');
   ```
  
4. Create a URL-type menu in your Menu Configuration and enter the link:
  
   _index.php?module=roox/custom_module/code_

   The first time you access the page, a table will be created in your database.
   
# How to use
The usage is similar to **Custom PHP**.
The only difference is that Custom PHP only for creating function or class, this plugin is more flexible.
1. Create folder, if needed, where you want to place the module in.
2. Create a module indicated with a parameter name (without space).
3. Create PHP script to process/generate some data or to generate a view. 
4. Access the module via **_index.php?module=/custom_module/parse&name=parameterName_** (replace _parameterName_ with your input in step 2).
