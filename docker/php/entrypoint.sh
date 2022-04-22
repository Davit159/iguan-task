#!/usr/bin/env bash

set -x

WORKER_MEMLIMIT=${WORKER_MEMLIMIT:-128M}
WORKER_TIMELIMIT=${WORKER_TIMELIMIT:-3600}
MESSAGES_COUNT=${MESSAGES_COUNT:-100}

# SIGTERM-handler
term_handler() {
  if [ $pid -ne 0 ]
  then
    echo -e "\n\tSIGNAL CATCHED SUCCESSFULLY\n"
    php bin/console messenger:stop-workers
    wait "$pid"
  fi
}

# setup handlers
# on callback, kill the last background process and execute the specified handler
trap 'term_handler' SIGTERM

# run application
php bin/console messenger:consume async async_feedback_sqs async_license_review_sqs --limit=${MESSAGES_COUNT} --memory-limit=${WORKER_MEMLIMIT} --time-limit=${WORKER_TIMELIMIT} -vv &
pid="$!"

# wait indefinitely
echo "Waiting for pid: ${!}"
wait ${!}
