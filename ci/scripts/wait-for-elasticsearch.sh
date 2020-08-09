#!/bin/bash
source $(dirname $0)/util/backoff.sh

host="$1"

# Wait until the ES instance responds to requests
# If it doesn't, we bail.
backoff curl --fail "$host" || exit 1