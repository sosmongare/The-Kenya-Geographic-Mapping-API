<?php

namespace App\Http\Controllers;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         title="Kenya Administrative Boundaries API(KenyaAdminAPI) - Documentation",
 *         version="1.0.0",
 *         description="The Kenya Administrative Boundaries API (KenAdminAPI) provides a comprehensive and easy-to-use interface for accessing detailed information about Kenya's administrative divisions, including Counties, Constituencies, and Wards. This API is designed to help developers integrate location-based data into their applications, supporting a wide range of use cases from geographical analysis to service delivery.",
  *         @OA\Contact(
 *             email="sosmongare@gmail.com",
 *         ),
 *     ),
 *     @OA\Server(
 *         url="http://127.0.0.1:8000",
 *         description="Local server"
 *     ),
 *     @OA\Server(
 *         url="https://127.0.0.1:8000",
 *         description="Production server"
 *     ),
 *     @OA\Tag(
 *         name="Counties",
 *         description="Endpoints related to counties"
 *     ),
 *     @OA\Tag(
 *         name="Constituencies",
 *         description="Endpoints related to constituencies"
 *     ),
 *     @OA\Tag(
 *         name="Wards",
 *         description="Endpoints related to wards"
 *     )
 * )
 */
class ApiDocumentation
{
}
