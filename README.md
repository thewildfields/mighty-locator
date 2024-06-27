# Mighty Locator #

## Project Description ##
This project was created as a tool for process server community. It utilizes 2 API providers for the person data.

## Technology Stack ##
The project is built on the WordPress. It consists of 2 custom plugins and a theme.

### ML Plugin ##
The "ML" plugin is responsible for the search functionality. The API calls are being sent to app.directskip.com and openpeoplesearch.com. The search results from these APIs are very different, so there is a lot of data processing needed to filter and sort the data.
The other complication is that OpenPeopleSearch returns data as a set of records. These records sometimes represent the same person or different people with the same first and last name. Unfortunately, there is no unique ID, so a specific matching algorythm was developed to sort this data.
After processing the data, it can be accessed using the custom WordPress Rest Api endpoints.

### Mighty Locator Blocks Plugin ### 
This plugin creates a set of custom WordPress blocks to access and display the people data.
