import {
    Breadcrumb,
    BreadcrumbEllipsis,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbSeparator,
} from "@/components/ui/breadcrumb"
import { Head, Link } from "@inertiajs/react"
import AppLayout from "@/layouts/app-layout"
import RespondentForm from "./components/RespondentForm"
import { Skm } from "@/types"

interface FormPageProps {
    title: string,
    uuid: string,
    serviceId: number,
    skm: Skm
}

export default function FormPage({ title, uuid, serviceId, skm }: FormPageProps) {

    return (
        <AppLayout>
            <Head title={title} />
            <div className="mb-5">
                <h1 className="text-3xl font-serif font-bold mb-1">
                    {skm.unor.name}
                </h1>
                <span className="text-sm text-muted-foreground line-clamp-2">
                    {skm.unor.address}
                </span>

                <div className="mt-5">
                    <Breadcrumb>
                        <BreadcrumbList>
                            <BreadcrumbItem>
                                <BreadcrumbLink >
                                    <Link>Beranda</Link>
                                </BreadcrumbLink>
                            </BreadcrumbItem>
                            <BreadcrumbSeparator />
                            <BreadcrumbEllipsis className="size-4" />
                            <BreadcrumbSeparator />
                            <BreadcrumbItem>
                                <BreadcrumbLink asChild>
                                    <Link href={route('survey.services', uuid)}>Layanan</Link>
                                </BreadcrumbLink>
                            </BreadcrumbItem>
                            <BreadcrumbSeparator />
                            <BreadcrumbItem>
                                <BreadcrumbLink asChild>
                                    <Link className="text-foreground">Formulir</Link>
                                </BreadcrumbLink>
                            </BreadcrumbItem>
                        </BreadcrumbList>
                    </Breadcrumb>
                </div>
            </div>

            <RespondentForm
                uuid={uuid}
                serviceId={serviceId}
            />

        </AppLayout>
    )
}
