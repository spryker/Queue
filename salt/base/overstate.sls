kernel_install:
  match: '*'
  sls:
    - system.repositories
    - system.kernel_install

prepare-system:
  match: '*'
  require:
    - kernel_install
  sls:
    - system.minion
    - system.filesystems

clear-couchbase-client-configuration-cache:
  match: '*'
  require:
    - prepare-system
  sls:
    - system.clear-couchbase-client-configuration-cache

highstate-on-all-nodes:
  match: '*'
  require:
    - clear-couchbase-client-configuration-cache
