# Rancher Configuration

This [Rancher configuration](http://docs.rancher.com/rancher/rancher-compose/) is intended to make it quick and painless for you to deploy your application to Rancher.

### How to use

This example is for a **staging** environment.

 * Configure the environment variables in the docker-compose to meet your needs
 * Replace any values wrapped in `[]`
 * Replace image names with your own
 * [Add a stack](http://docs.rancher.com/rancher/rancher-ui/applications/stacks/) within Rancher and include your config files

#### Using in production

 * Remove the `reset-database` service
 * Update image tags
 * Update environment variables accordingly