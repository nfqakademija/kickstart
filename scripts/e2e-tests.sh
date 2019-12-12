#!/usr/bin/env bash

# Make us independent from working directory
pushd `dirname $0` > /dev/null
SCRIPT_DIR=`pwd`
popd > /dev/null

NETWORK=$(docker inspect nginx.symfony --format='{{range $networkName, $details := .NetworkSettings.Networks}}{{$networkName}}{{end}}')

docker run \
    --volume "${SCRIPT_DIR}/../tests/e2e:/e2e" \
    --workdir="/e2e" \
    --entrypoint=cypress \
    --network="${NETWORK}" \
    "cypress/included:3.2.0" \
    run --env "BASE_URL=http://nginx.symfony:80"
