module.exports = {
  apps : [{
    name : "respund-collector-nodeserver",
    script : "server.js",
    watch : true,
    cwd : "/var/www/example.com/src/nodeserver",
    max_memory_restart: "300M"
  }]
}
