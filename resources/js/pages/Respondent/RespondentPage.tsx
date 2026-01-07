import {
    Breadcrumb,
    BreadcrumbItem,
    BreadcrumbLink,
    BreadcrumbList,
    BreadcrumbSeparator,
} from "@/components/ui/breadcrumb"
import { Link, Head } from "@inertiajs/react"
import AppLayout from "@/layouts/app-layout"
import { RefreshCcwIcon, SearchIcon, Undo2Icon } from "lucide-react"
import { Select } from "@/components/ui/select"
import { SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from "@/components/ui/select"
import { SearchableSelect } from "@/components/SearchableSelect"
import { useState } from "react"
import { Unor } from "@/types"
import { Button } from "@/components/ui/button"

interface RespondentPageProps {
    // title: string,
    unors: Unor[],
}

export default function RespondentPage({ unors }: RespondentPageProps) {

    let years = [];
    let currentYear = new Date().getFullYear();
    for (let year = currentYear; year >= 2021; year--) {
        years.push(year);
    }

    const [selectedUnor, setSelectedUnor] = useState("");
    const unor = unors.map((unor) => {
        return { label: unor.name, value: unor.id.toString() }
    })

    console.log(selectedUnor);

    return (
        <AppLayout>
            <Head title="Responden" />
            <div className="mb-5">
                <h1 className="text-3xl font-serif font-bold mb-1">
                    Responden
                </h1>
                <span className="text-sm text-muted-foreground line-clamp-2">
                    Data Responden yang telah mengisi Survei Kepuasan Masyarakat
                </span>

                <div className="mt-5">
                    <Breadcrumb>
                        <BreadcrumbList>
                            <BreadcrumbItem>
                                <BreadcrumbLink asChild>
                                    <Link>Beranda</Link>
                                </BreadcrumbLink>
                            </BreadcrumbItem>
                            <BreadcrumbSeparator />
                            <BreadcrumbItem>
                                <BreadcrumbLink asChild>
                                    <Link className="text-foreground">Organisasi Pemerintah Daerah</Link>
                                </BreadcrumbLink>
                            </BreadcrumbItem>
                        </BreadcrumbList>
                    </Breadcrumb>
                </div>
            </div>

            <div className="flex gap-3">
                <Select defaultValue={currentYear.toString()} >
                    <SelectTrigger className="w-32">
                        <SelectValue />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            {
                                years.map((year, index) => (
                                    <SelectItem key={index} value={year.toString()}>
                                        {year}
                                    </SelectItem>
                                ))
                            }
                        </SelectGroup>
                    </SelectContent>
                </Select>

                <SearchableSelect
                    options={unor}
                    value={selectedUnor.toString()}
                    onChange={setSelectedUnor}
                    placeholder="Provinsi Gorontalo"
                    className="w-96"
                />

                <Button variant="secondary">
                    <RefreshCcwIcon className="h-4 w-4" />
                </Button>

            </div>


        </AppLayout>
    )
}
