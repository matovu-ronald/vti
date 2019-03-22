<?php

/**
 * Check whether a user has permission to perform a certain action
 *
 * @param $request
 * @param null $actionName
 * @param null $id
 * @return bool
 */
function check_user_permissions($request, $actionName = NULL, $id = NULL)
{
    /* Get currently logged in user */
    $currentUser = auth()->user();

    /* Current Action Name */
    if ($actionName) {
        $currentActionName = $actionName;
    }

    /* Get current controller and method name */
    $currentActionName = $request->route()->getActionName();

    /* Get controller and action name from the action name */
    list($controller, $method) = explode('@', $currentActionName);
    $controller = str_replace(["App\\Http\\Controllers\Api\\", "Controller"], "", $controller);

    /* Create, Read, Update, Delete mapping to controller actions */
    $crudPermissionMap = [
        'create' => ['create', 'store'],
        'update' => ['edit', 'update'],
        'delete' => ['destroy', 'restore', 'forceDestroy'],
        'read' => ['index', 'view'],
    ];

    foreach ($crudPermissionMap as $permission => $methods) {
        if (in_array($method, $methods)) {

            /**
             * If you have a specific restriction you want to make on a user not accessing
             * Another persons resource replicate this code below
             * Retrieve the route parameter check whether the current user id and
             * the foreign id of the user in the resource match, they donot match return a
             * 403 abort error message
             * Turn the down if into an if else
             */
            /*if (from_camel_case($controller) == 'service_request' && in_array($method, ['edit', 'update', 'destroy', 'restore', 'forceDestroy', 'view', 'index'])) {

                $id = !is_null($id) ? $id : $request->route('');

                // If the current user has no permission to access other people's service requests permission
                // Make sure he/she only modifies his/her service requests
                if (($id) && (!$currentUser->can("") || !$currentUser->can(""))) {
                    $serviceRequest = ServiceRequest::find($id);
                    if($serviceRequest->customer_id !== $currentUser->id) {
                        return false;
                    }
                }

            }*/
            // If user has no permission donot allow next request
            /*else if (! $currentUser->can(from_camel_case($controller).".{$permission}")) {
                return false;
            }*/


            break;

        }
    }

    return true;
}

/**
 * Convert word from pascal or camel case to snake case
 *
 * @param $input
 * @return string
 */
function from_camel_case($input)
{
    preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
    $ret = $matches[0];
    foreach ($ret as &$match) {
        $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
    }
}

