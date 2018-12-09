Storage - manage your remote filesystems in one place.

### Installation
Clone repository:

    git clone https://github.com/ksachajko/storage.git

In application dir, run:
     
    composer install

### Configuration

Currently supported storages are: Dropbox, Google Drive and local filesystem.

Configure environment:

    # .env
    // ...
    DROPBOX_TOKEN=token
    DROPBOX_ROOT_DIRECTORY=root_directory
      
    GOOGLE_DRIVE_CLIENT_ID=client_Id
    GOOGLE_DRIVE_CLIENT_SECRET=client_secret
    GOOGLE_DRIVE_REFRESH_TOKEN=refresh_token
    GOOGLE_DRIVE_ROOT_DIRECTORY=root_directory

Directory for local storage can be set in:

     # config/packages/oneup_flysystem.yaml
     oneup_flysystem:
          adapters:
              local_adapter:
                  local:
                      directory: '%kernel.root_dir%/../uploads'

### Extending

Internally, Storage uses The PHP League Flysystem and its integration for Symfony - OneupFlysystemBundle.
New filesystem can be easily added by creating an adapter (or using existing one) and injecting it to a
filesystem. Example below shows configuration for local filesystem:

    # config/packages/oneup_flysystem.yaml
    oneup_flysystem:
        adapters:
            local_adapter:
                local:
                    directory: '%kernel.root_dir%/../uploads'
        filesystems:
            local:
                adapter: local_adapter
                mount: local

New filesystem name needs to be added to enabled_filesystems parameter:

    # config/services.yml
    parameters:
         // ...
         enabled_filesystems:
             - local
             - dropbox
             - google_drive
             - new_filesystem

There are many existing adapters. Please refer to the official documentations to find them:

- [Flysystem](https://github.com/thephpleague/flysystem)
- [OneupFlysystemBundle](https://github.com/1up-lab/OneupFlysystemBundle)

### Usage

In application dir, enable built-in web server:

    bin/console server:start

In order to list all files, go to:

    http://localhost:8000/files

Type file name (or part of it) and press Search button to filter the results.

### Tests

    bin/behat
     
    bin/phpspec run

### TODO
- docker
- use symfony/skeleton instead of symfony/website-skeleton
- use modern front framework + API
- CI flow
