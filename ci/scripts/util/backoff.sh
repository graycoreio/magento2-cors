#!/bin/bash

function backoff {
    local backOffTime=2
    local attempt=1
    local maxAttempts=5
    local exitCode=0

    while (("$attempt" < "$maxAttempts"))
    do
        result=$("$@")
        exitCode=$?
        
        echo $result
        
        # Woohoo! We've succeeded!
        if [ "$exitCode" -eq "0" ]
        then
            break
        fi 

        # Alrighty then, something went sideways.
        echo "Failure, backing off. Attempt: $attempt"
        sleep $backOffTime

        attempt=$((attempt + 1))
        
        # Backoff in doubles
        backOffTime=$(($backOffTime * 2))
    done

    # We failed.
    if [[ $exitCode != 0 ]]
    then
        echo "Failed after $maxAttempts attempts..."
    fi

    return $exitCode;
}