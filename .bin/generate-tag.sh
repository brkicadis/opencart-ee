REPO=`git config remote.origin.url`
SSH_REPO=${REPO/https:\/\/github.com\//git@github.com:}

if [[ $TRAVIS_BRANCH == 'master' ]]; then
    if [[ $TRAVIS_PULL_REQUEST == 'false' ]]; then
        VERSION=`cat VERSION`
        STATUS=`curl -s -o /dev/null -w "%{http_code}" -H "Authorization: token ${GITHUB_TOKEN}" https://api.github.com/repos/wirecard/opencart-ee/git/refs/tags/${VERSION}`

        if [[ ${STATUS} == "200" ]] ; then
            echo "Tag is up to date with version."
            exit 0
        elif [[ ${STATUS} != "404" ]] ; then
            echo "Got status ${STATUS} from GitHub. Exiting."
            exit 0
        else
            echo "Version is updated, creating tag ${VERSION}"
        fi

        git config user.name "Travis CI"
        git config user.email "wirecard@travis-ci.org"

        git tag -a ${VERSION} -m "Pre-release version"
        git push ${SSH_REPO} master ${VERSION}
    fi
fi
